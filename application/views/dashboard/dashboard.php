<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
 
<div class='container shadow padding-top10'>

    <div class='row'>
	<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
			  
			  
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                 My Tutorials
                </a>
              </li>
			  
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                  My Blogs
                </a>
              </li>
            
             
            </ul>
 
            
          </div>
        </nav>
		
		
		
        <div class='col-lg-9'>
       <h1>Dashboard</h1>
      <hr>
			<div class='row'> 
				 <div class='col-lg-6'>
					<h4>My Tutorials</h4>
					
						<div class="data">
							<ul class="list-group">
								<?php foreach($tutorial as $value): ?>
								<li class="list-group-item"><a href='<?php echo base_url('edit/post/').$value->id; ?>'><?php echo $value->post_title; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
				 </div>
				 <div class='col-lg-6'>
				 	<h4>My Blogs</h4>
						<div class="data">
							
						</div>
				 </div>
			</div>
	  
        </div>
    </div>
</div>