<div class="wrapper-codes" style="min-height:500px; margin-top:100px;">

    <div class="container">
        <?php 
        // Fetch notifications with descending order of release date
        $timetable = fuel_model('timetable', [
            'where' => ['published' => 'yes']
        ]);
        $id = 1;

        // Check if there are any notifications
        if (!empty($timetable) && is_array($timetable)): 
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
                    <?php foreach ($timetable as $key => $item): ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td><?php echo $item['headline']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <td><?php echo $item['release_date']; ?></td>
                            <td>
                                <?php if (!empty($item['pdf'])): ?>
                                    <a href="<?= site_url('assets/images/timetable/' . $item['pdf']); ?>" target="_blank">
                                        <img src="<?= img_path('timetable/pdficn.svg'); ?>" alt="View PDF">
                                    </a>
                                <?php else: ?>
                                    <a href="#" target="_blank">
                                        <img src="<?= img_path('timetable/pdficn.svg'); ?>" alt="Unavailable">
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center">
                <p>No Timetable information available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>









