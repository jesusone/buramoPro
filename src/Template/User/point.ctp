<div class="UserPoints index large-9 medium-8 columns content">
    <h3><?= __('User Point') ?></h3>
    <?= $this->Form->create(null, ['url' => ['controller' => 'User', 'action' => 'point'] ]); ?>
        <div class="control-group">
            <label for="startTime" class="control-label">From</label>
            <div class="controls">
                <div class="input-group">
                    <input id="startTime" name="startTime" type="text" class="date-picker form-control" />
                </div>
            </div>
            <label for="endTime" class="control-label">To</label>
            <div class="controls">
                <div class="input-group">
                    <input id="endTime" name="endTime" type="text" class="date-picker form-control" />
                </div>
            </div>
        </div>
        <br>
        <?= $this->Form->button(__('Search')) ?>
        <?= $this->Form->end()
    ?>
    <br>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('fortune name') ?></th>
                <th><?= $this->Paginator->sort('point') ?></th>
                <th><?= $this->Paginator->sort('money_value') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($UserPoints as $userPoint): ?>
            <tr>
                <td><?= h($userPoint->fortune['name']) ?></td>
                <td><?= h($this->Number->format($userPoint->point)) ?></td>
                <td><?= h($this->Number->format($userPoint->money_value)) ?></td>
                <td><?= h($userPoint->date) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script>
    $(".date-picker").datepicker();

    $(".date-picker").on("change", function () {
        var id = $(this).attr("id");
        var val = $("label[for='" + id + "']").text();
        $("#msg").text(val + " changed");
    });
</script>
