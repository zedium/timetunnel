<?php
if( !class_exists('TimeTunnel')  ){
	class TimeTunnel{
		
		
		public function getPosts($c){
			
			$postCount = $c;
			$year = date('y');
			$month = date('m');
			$day = date('d');
			
			$output = '';
			$defaultArgs = array(
			
				'post_type' => 'post',
				'paged' => 1,
				'posts_per_page'=> $postCount,
				'date_query' => array(
					'y' => $year,
					'monthnum' => $month,
					'day' => $day,
					
					'before' => array(
						'y'=> $year
					),
					
				),
				
				
			);
			
			$query = new WP_Query($defaultArgs);
			
			if( $query->have_posts() )
				while( $query->have_posts() )
				{
					$query->the_post();
					
					$output .= '<ul class="timetunnel">';
					$output .= '<li><a href="'. get_permalink() .'">'. get_the_title() .' - ('. get_the_time('M d, Y') .')</a></li>';
					$output .= '</ul>';
					
				}
				
			return $output;
			
		}
		
	}
}