        <div class="box banner">       
            <h1>Cat Characteristics</h1>
        </div>    <!-- / banner -->

        <!-- Navigation goes here.  Edit BOTH the file name and the link name -->
        <div class="box nav">
            
            <div class="linkwrapper">
                <div class="commonsearches">
                    <a href="index.php?page=all_results&search=all">All Cats</a> | 
                    <a href="index.php?page=all_results&search=recent">Recent</a> | 
                    <a href="index.php?page=all_results&search=random">Random</a> 
                </div>  <!-- / common searches -->
            
                <div class="topsearch">
                    
                    <!-- Quick Search -->           
                    <form method="POST" action="index.php?page=quick_search" 
                    enctype="multipart/form-data">

                        <input class="search quicksearch" 
                        type="text" name="quick_search" size="40" 
                        value="" required placeholder="Quick Search...">

                        <select class ="quick-choose" name="search_type" required>
                            <option value="" selected disabled>Search type</option>
                            <option value="all">All</option>
                            <option value="Breeds">Breeds</option>
                            <option value="Temprements">Temprements</option>
                        </select>


                        <input class="submit" 
                            type="submit" name="find_quick" value="&#xf002;">

                    </form>     <!-- / quick search -->
				                   
                </div>  <!-- / top search -->
                
                <div class="topadmin">
					
					<?php
					
					if(isset($_SESSION['admin'])) {
						
						?>
						
					<a href="index.php?page=../admin/add_entry">
						<i class="fa fa-plus fa-2x"></i></a>
						&nbsp; &nbsp;
					
					<a href="index.php?page=../admin/logout">
						<i class="fa fa-sign-out fa-2x"></i></a>
					
					
					<?php
						
						
					} else {

					?>
					
                    <a href="index.php?page=../admin/login">
						<i class="fa fa-sign-in fa-2x"></i></a>
					
					<?php } ?>
                    
                </div>  <!-- / top admin -->
                
            </div>  <!--- / link wrapper -->
            
        </div>    <!-- / nav --> 