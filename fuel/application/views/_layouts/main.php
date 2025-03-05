
<?php $this->load->view('_blocks/header'); ?>

<?php if (is_home()): ?>

    <?php echo fuel_var('body', 'This is under construction...'); ?>

<?php else: ?>

    <div class="inner-page-section">
        <div class="container py-2">
            <nav class="breadcrumb" style="margin-top: 130px;">
                <!-- Breadcrumb Navigation -->
                <ol class="breadcrumb mb-0 pt-2">
                    <li class="breadcrumb-item active">
                        <a href="<?php echo $this->uri->segment(2); ?>" class="breadcrumb-link" style="text-decoration:none;margin-left:40px;">
                            <?php echo $this->fuel->navigation->breadcrumb_new(array('class' => ' ', 'arrow_class' => 'hide')); ?>
                        </a>
                    </li>
                </ol>
            </nav>
	</div>
            <div class="inner-heading">
                <?php echo fuel_var('page_title'); ?>
            </div>
        </div>

        <div>
            <?php echo fuel_var('body', '<img class="img-responsive" src=' . '{img_path("webapp/underConstruction.png")}' . ' alt="Under Construction" />'); ?>

            <?php if (uri_segment(1) == 'departments'): ?>
                <?php echo fuel_block('departments/related_contents'); ?>
            <?php endif; ?>
        </div>
    

<?php endif; ?>

<?php $this->load->view('_blocks/footer'); ?>
