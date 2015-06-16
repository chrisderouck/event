<article>
    <h2><?=$this->Html->link($event['Node']['title'], $event['Node']['path'])?></h2>

    <?=$event['Node']['body']?>

    <?php if(isset($event['LinkedAssets']) && isset($event['LinkedAssets']['FeaturedImage'])): ?>
        <?=$this->Html->image(str_replace('\\','/',$event['LinkedAssets']['FeaturedImage']['path']))?>
    <?php endif; ?>

    <?php if(isset($event['Taxonomy']) && count($event['Taxonomy']) > 0): ?>
        <?php foreach($event['Taxonomy'] as $taxo): ?>
            <?=$this->Html->link($taxo['Term']['title'], array(
                'admin' => false,
                'plugin' => 'nodes',
                'controller' => 'nodes',
                'action' => 'term',
                'type' => $taxo['Vocabulary']['alias'],
                'slug' => $taxo['Term']['slug']
            ));?>
        <?php endforeach; ?>
    <?php endif; ?>
</article>
