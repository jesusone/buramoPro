<div class="users index large-9 medium-8 columns content">
    <h3><?= __('User Level') ?></h3>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
        <tr>
            <?php foreach ($listType as $type): ?>
                <th><?= $this->Html->image($type->image, ["alt" => "type image"]) ?></th>

            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($listType as $type): ?>
                    <td><?= $type->name ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($listType as $type): ?>
                    <td><?= $type->description ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>

</div>
