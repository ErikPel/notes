<?php
/**
 * Copyright (c) 2013, Bernhard Posselt <dev@bernhard-posselt.com>
 * Copyright (c) 2013, Jan-Christoph Borchardt http://jancborchardt.net
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING file.
 */


script('notes', [
    'vendor/bootstrap/tooltip',
    'vendor/angular/angular',
    'vendor/angular-route/angular-route',
    'vendor/restangular/dist/restangular',
    'vendor/underscore/underscore',
    'vendor/prism/prism',
    'vendor/mdEdit/mdedit.min',
    'public/app.min',
    'vendor/jquery-ui-signature/excanvas',
    'vendor/jquery-ui-signature/jquery.signature',
    'vendor/jquery-ui-signature/signature',

]);

style('notes', [
    '../js/vendor/mdEdit/mdedit',
    '../js/vendor/mdEdit/prism',
    'vendor/bootstrap/tooltip',
    'notes',
    'jquery.signature'
]);

?>
<div id="app" ng-app="Notes" ng-controller="AppController"
    ng-init="init(<?php p($_['lastViewedNote']); ?>)" ng-cloak>

    <script type="text/ng-template" id="note.html">
        <?php print_unescaped($this->inc('note')); ?>
    </script>

    <div id="app-navigation" ng-controller="NotesController">
        <ul>
            <!-- new note button -->
            <li id="note-add" ng-click="create()"
                oc-click-focus="{ selector: '#app-content textarea' }">
                <a href='#'>+ <span><?php p($l->t('New note')); ?></span></a>
            </li>
            <!-- notes list -->
            <li ng-repeat="note in notes|orderBy:'modified':'reverse'"
                ng-class="{ active: note.id == route.noteId }">
                <a href="#/notes/{{ note.id }}">
                    {{ note.title | noteTitle }}
                </a>
                <span class="utils">
                    <button class="svg action icon-delete"
                        title="<?php p($l->t('Delete note')); ?>"
                        notes-tooltip
                        data-placement="bottom"
                        ng-click="delete(note.id)"></button>
                </span>
            </li>

        </ul>
    </div>

    <div id="app-content" ng-class="{loading: is.loading}">
        <div id="controls"><div class="actions creatable"><button ng-click="writebyHand()" href="#" class="button new" data-original-title="" title=""><img src="/owncloud/core/img/actions/add.svg" alt="Uusi"></button></div></div>
        <div id="app-content-container" ng-view></div>
    </div>
</div>
