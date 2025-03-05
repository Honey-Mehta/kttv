<div class="wrapper-codes" style="min-height:500px; margin-top:100px;">

    <div class="container">
        <?php 
        // Fetch notifications with descending order of release date
        $news = fuel_model('notifications', [
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
                        <th>Heading</th>
                        <th>Description</th>
                        <th>Release Date</th>
                        <th>View PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $key => $item): ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td><?php echo $item['headline']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <td><?php echo $item['release_date']; ?></td>
                            <td>
                                <?php if (!empty($item['pdf'])): ?>
                                    <a href="<?= site_url('assets/images/notifications/' . $item['pdf']); ?>" target="_blank">
                                        <img src="<?= img_path('notifications/pdficn.svg'); ?>" alt="View PDF">
                                    </a>
                                <?php else: ?>
                                    <a href="#" target="_blank">
                                        <img src="<?= img_path('notifications/pdficn.svg'); ?>" alt="Unavailable">
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center">
                <p>No notifications available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>









