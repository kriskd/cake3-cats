<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Cat'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="cats index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('is_alive') ?></th>
            <th><?= $this->Paginator->sort('weight') ?></th>
            <th><?= $this->Paginator->sort('gender') ?></th>
            <th><?= $this->Paginator->sort('ssn') ?></th>
            <th><?= $this->Paginator->sort('birth_year') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cats as $cat): ?>
        <tr>
            <td><?= h($cat->name) ?></td>
            <td><?= h($cat->is_alive) ?></td>
            <td><?= h($cat->readable_weight) ?></td>
            <td><?= $this->Catnip->gender($cat->gender) ?></td>
            <td><?= h($cat->ssn) ?></td>
            <td><?= h($cat->birth_year) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $cat->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cat->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cat->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

    <dl>
        <dt>Heaviest</dt>
        <dd><?php echo $heaviest->name; ?> Age: <?php echo $heaviest->age; ?></dd>
        <dt>Heaviest Female</dt>
        <dd><?php echo $heaviestFemale->name; ?> Age: <?php echo $heaviestFemale->age; ?></dd>
        <?php //foreach($genderCount as $count): ?>

        <?php //endforeach; ?>
    </dl>
</div>
