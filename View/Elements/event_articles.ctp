<?php
usort($events, function($a, $b){
    return $a['Event']['start_date'] > $b['Event']['start_date'];
});

foreach ($events as $node):
    $this->Nodes->set($node);
    ?>
        <div id="node-<?php echo $this->Nodes->field('id'); ?>" class="node node-type-<?php echo $this->Nodes->field('type'); ?>">
            <a href="<?=$this->Html->url($node['Node']['path'])?>">
                <h1><?=$this->Nodes->field('title')?></h1>
                <?php
                echo $this->Nodes->info();
                echo $this->Nodes->body();
                ?>
            </a>
            <?php
                echo $this->Nodes->moreInfo();
            ?>
        </div>
<?php
endforeach;
?>
