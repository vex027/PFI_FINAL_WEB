<div class="container border">
  <h3 class="my-4">Thread Favoris</h3>  
    <?php 
        arsort($_COOKIE);
        foreach($_COOKIE as $key=>$value){
            $nomCookie = explode ('-',$key);
            if(count($nomCookie) == 2){
                if($nomCookie[0] == "nbVisiteThread"){
                    $id = intval($nomCookie[1]);
                    if(is_int($id)){
                        $thread->load_thread_by_id($id);
                        $thread->display_thread();
                    }
                }
            }
        }
    ?>
</div>

