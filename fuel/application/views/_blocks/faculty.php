<div class="wrapper-codes">
    <div class="page-title">
        <div class="container">
            <h2>Faculty Details</h2>
        </div>
    </div>

    <div class="container">
        <div class="row faculty-lists">
            <?php 
            // Fetch only published faculty data from the table
            $facultyMembers = fuel_model('faculty', ['where' => ['published' => 'yes']]); 
            
            if (!empty($facultyMembers)): // Check if there are records
            ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                            $id=1;

                    foreach ($facultyMembers as $faculty): ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td><?php echo $faculty['name']; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No published faculty members found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
