<div class="py-5 bg-light border-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-4">
                <h4 class="footer-heading"><?php echo $setting['title'] ?? 'SUP'; ?></h4>
                <hr>
                <p>
                    <?php echo $setting['small_description'] ?? 'Ecole'; ?>
                </p>
            </div>
            <div class="col-md-6">
                <h4 class="footer-heading">Contact Information</h4>
                <hr>
                <p>Address :<?php echo $setting['address'] ?? ''; ?></p>
                <p>Email 1 :<?php echo $setting['email1'] ?? ''; ?></p>
                <p> Email 2 :<?php echo $setting['email2'] ?? ''; ?></p>
                <p>tel :<?php echo $setting['tel'] ?? ''; ?></p>
            </div>
        </div>
    </div>
</div>
