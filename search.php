<?php include_once 'inc/header.php'; ?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $real = mysqli_real_escape_string($db->link, $_GET['search']);
        if (!isset($real) || $real == null) {
            header('location: 404.php');
        } else {
            $search = $real;
        }
        $sql = "SELECT * from tbl_post where title LIKE '%$search%' OR body LIKE '%$search%' ";
        $post = $db->select($sql);
        if ($post) {
            while ($result = $post->fetch_assoc()) {
                $c = $result['cat'];
        ?>
                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                    <h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="#"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="post image" /></a>
                    <p>
                        <?php echo $fm->textShorten($result['body']); ?>
                    </p>
                    <div class="readmore clear">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>
        <?php  }
        } else echo "No post found"; ?>

        <div class="relatedpost clear">
            <?php if ($post) { ?>
                <h2>Related articles</h2>
                <?php
                $sql = "SELECT * from tbl_post where title LIKE '%$search%' OR body LIKE '%$search%' ";
                $post = $db->select($sql);
                $result = $post->fetch_assoc();
                $category = $result['cat'];
                $query_category = "select * from tbl_post where cat = '$category' order by rand() limit 6";
                $related_post = $db->select($query_category);

                while ($result_related = $related_post->fetch_assoc()) {
                ?>

                    <a href="post.php?id=<?php echo $result_related['id']; ?>"><img src="admin/uploads/<?php echo $result_related['image']; ?>" alt="post image" /></a>
            <?php
                }
            } else {
                echo 'no related post available';
            }

            ?>
        </div>
    </div>
    <?php include_once 'inc/sidebar.php'; ?>
    <?php include_once 'inc/footer.php'; ?>