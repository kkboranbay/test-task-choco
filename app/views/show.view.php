<ul>
    <li>
        <strong>ID акции</strong>: <?= $promotion->id ?>
    </li>
    <li>
        <strong>Название акции</strong>: <?= $promotion->title ?>
    </li>
    <li>
        <strong>Дата начала акции:</strong> <?= gmdate("d-m-Y", $promotion->start_date) ?>
    </li>
    <li>
        <strong>Дата окончания:</strong> <?= gmdate("d-m-Y", $promotion->end_date) ?>
    </li>
    <li>
        <strong>Статус:</strong> <?= $promotion->status == 1 ? 'On' : 'Off' ?>
    </li>
</ul>


<form action="/update/<?= $promotion->id ?>" method="post">
    <input type="submit" value="Обновить статус" />
</form>
