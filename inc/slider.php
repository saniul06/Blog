<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $query = 'select * from tbl_slider';
        $result = $db->select($query);
        if ($result) {
            while ($data = $result->fetch_assoc()) { ?>
                <a href="#"><img src="images/slideshow/<?php echo $data['image']; ?>" alt="nature 1" title="This is slider one Title or Description" /></a>

        <?php      }
        } ?>
    </div>

</div>