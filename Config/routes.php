<?php
    CroogoRouter::connect('/events', array('plugin' => 'event', 'controller' => 'events', 'action' => 'overview'));
    CroogoRouter::connect('/events/future', array('plugin' => 'event', 'controller' => 'events', 'action' => 'overview'));
    CroogoRouter::connect('/events/passed', array('plugin' => 'event', 'controller' => 'events', 'action' => 'old_events'));

    CroogoRouter::connect('/events/calendar', array('plugin' => 'event', 'controller' => 'events', 'action' => 'index'));
    CroogoRouter::connect('/events/hmtview/*', array('plugin' => 'event', 'controller' => 'events', 'action' => 'hmtview'));
