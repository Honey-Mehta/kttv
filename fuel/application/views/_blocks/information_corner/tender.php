<div class="wrapper-codes" style="min-height:500px; margin-top:100px;">

    <div class="container">
        <?php 
        // Fetch notifications with descending order of release date
        $news = fuel_model('tender', [
            'where' => ['published' => 'yes']
        ]);
        $id = 1;

        // Check if there are any notifications
        if (!empty($news) && is_array($news)): 
        ?>
            <table class="table rablutable">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Tender Date</th>
                        <th>View PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $key => $item): ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <td><?php echo $item['tender_date']; ?></td>
                            <td>
                                <?php if (!empty($item['pdf'])): ?>
                                    <a href="<?= site_url('assets/tender/' . $item['pdf']); ?>" target="_blank">
                                        <img src="<?= img_path('tender_icon/pdficn.svg'); ?>" alt="View PDF">
                                    </a>
                                <?php else: ?>
                                    <a href="#" target="_blank">
                                        <img src="<?= img_path('tender_icon/pdficn.svg'); ?>" alt="Unavailable">
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center">
                <p>No Tender available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>




