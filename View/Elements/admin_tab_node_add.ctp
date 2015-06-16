<?php
    echo $this->Form->input('Event.start_date', array('class'=>'input-datetime', 'type'=>'text'));
    echo $this->Form->input('Event.end_date', array('class'=>'input-datetime', 'type'=>'text'));

    if (Configure::read('Event.show_organiser')){
        echo $this->Form->input('Event.organiser', array('type'=>'text'));
    }
