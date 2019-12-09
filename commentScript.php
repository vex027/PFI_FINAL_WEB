<script>
        $(document).ready( function() {
            var CommentCount = 4;
            $("#comment-load-btn").click( function() {
                CommentCount = CommentCount + 4;
                document.cookie = 'commentCount-<?php echo $type.$parentID?>' + '='  +CommentCount;
            $("#comments").load("comment-loader.php?id=<?php echo $parentID?>&type=<?php echo $type?>", {
                newCommentCount: CommentCount
            }); 
        })});
</script>

