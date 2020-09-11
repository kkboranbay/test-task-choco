<div>
    <form action="import"
          method="post"
          name="frmCSVImport"
          id="frmCSVImport"
          enctype="multipart/form-data"
    >
        <div>
            <label>Choose CSV file</label>

            <input type="file"
                   name="file"
                   id="file"
                   accept=".csv"
            >
            <button type="submit"
                    id="submit"
                    name="import"
                    class="btn-submit"
            >Import</button>
        </div>
    </form>
</div>

<div>
    <?php
    if (! empty($promotions)) {
        ?>
        <table border="2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Status</th>
            </tr>
            </thead>
            <?php

            foreach ($promotions as $promotion) {
            ?>

            <tbody>
            <tr>
                <td><?= $promotion->id ?></td>
                <td><a href="<?= $promotion->id .'/'. Slug::generate($promotion->title) ?>"><?= $promotion->title ?></a></td>
                <td><?= $promotion->start_date ?></td>
                <td><?= $promotion->end_date ?></td>
                <td><?= $promotion->status ?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    <?php } ?>

</div>