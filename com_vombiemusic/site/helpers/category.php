<?php

	/**
	* Find the numbers of songs in a category
	* @catid is the id of the cateogry
	* @return the value of songs in category
	*/
        function countSongsCategory($catid){
                $db = JFactory::getDBO();
                $query = "SELECT * FROM #__vombiemusic_song WHERE published = '1' AND catid =".$db->quote($catid);
                $db->setQuery( $query );
                $rows = $db->loadObjectList();
                
                return count($rows); 
        }


?>