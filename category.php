<?php include_once 'inc/header.php'; ?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $real = mysqli_real_escape_string($db->link, $_GET['category']);
        if (!isset($real) || $real == null) {
            header('location: 404.php');
        } else {
            $category = $real;
        }

        $query_category = "select * from tbl_post where cat = '$category' order by rand() limit 6";
        $related_category = $db->select($query_category);
        if ($related_category) {
            while ($result = $related_category->fetch_assoc()) {
        ?>
                <div class="samepost clear">
                    <h2><a href="post.php?postid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                    <h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="post.php?postid=<?php echo $result['id']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="post image" /></a>
                    <p>
                        <?php echo $fm->textShorten($result['body']); ?>
                    </p>
                    <div class="readmore clear">
                        <a href="post.php?postid=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo 'No post available in this category';
        }
        ?>

    </div>
    <?php include_once 'inc/sidebar.php'; ?>
    <?php include_once 'inc/footer.php'; ?>