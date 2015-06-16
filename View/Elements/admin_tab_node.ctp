<?php
    echo $this->Form->input('Event.id');
    echo $this->Form->input('Event.node_id', array('type'=>'hidden', 'value'=>$this->data['Node']['id']));
    echo $this->Form->input('Event.start_date', array('class'=>'input-datetime', 'type'=>'text'));
    echo $this->Form->input('Event.end_date', array('class'=>'input-datetime', 'type'=>'text'));

    if (Configure::read('Event.show_organiser')){
        echo $this->Form->input('Event.organiser', array('type'=>'text'));
    }
