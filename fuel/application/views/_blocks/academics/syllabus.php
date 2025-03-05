<div class="wrapper-codes" style="min-height:500px; margin-top:100px;">

    <div class="container">
        <?php 
        // Fetch notifications with descending order of release date
        $syllabus = fuel_model('syllabus', [
            'where' => ['published' => 'yes']
        ]);
        $id = 1;

        // Check if there are any notifications
        if (!empty($syllabus) && is_array($syllabus)): 
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
                    <?php foreach ($syllabus as $key => $item): ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td><?php echo $item['headline']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <td><?php echo $item['release_date']; ?></td>
                            <td>
                                <?php if (!empty($item['pdf'])): ?>
                                    <a href="<?= site_url('assets/images/syllabus/' . $item['pdf']); ?>" target="_blank">
                                        <img src="<?= img_path('syllabus/pdficn.svg'); ?>" alt="View PDF">
                                    </a>
                                <?php else: ?>
                                    <a href="#" target="_blank">
                                        <img src="<?= img_path('syllabus/pdficn.svg'); ?>" alt="Unavailable">
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center">
                <p>No Syllabus available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>









