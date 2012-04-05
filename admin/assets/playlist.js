function deleteSongPlaylist(id,div){

var parent = div.getParent('div');
var url = 'index.php?option=com_vombiemusic&task=ajaxDeletePlaylistSong&' + token +'=1';
var request = new Request({
        url: url ,
        link: 'chain',
        method: 'get',
        data: {
          'delete': id,
        },
        onRequest: function() {
            new Fx.Tween(parent,{duration:300}).start('background-color', '#fb6c6c');
        },
        onSuccess: function() {
          new Fx.Slide(parent,{duration:300,onComplete: function() {parent.dispose();}}).slideOut();
        }
      }).send();
}

function ordering(id,order){

  var urltoupdate = 'index.php?option=com_vombiemusic&task=ajaxOrderingPlaylist&id='+id+'&order='+order+'&' + token + '=1&format=raw';
  new Request({
    url: urltoupdate,
    method: 'get',
    onSuccess: function(){ 
      updatePlaylist(); 
      $().setStyle('background','green'); 
      $('message').set('text','Ordering Updated:' + id);
    }
  }).send();

}

function updatePlaylist(){
  var urltoupdate = 'index.php?option=com_vombiemusic&task=ajaxNewPlaylistSong&loadsongs=1&playlist_id='+playlist_id+'&' + token + '=1&format=raw';
new Request.HTML({
  url: urltoupdate,
  method: 'get',
  update: 'allSongs',
  evalScripts: true, /* this is the default */
  onRequest: function(){$('allSongs').set('text', '<img src="components/com_vombiemusic/assets/img/spin.img" /> ' + urltoupdate);},
  onComplete: function(response){$('allSongs').empty().adopt(response);}}).send();
}

/* This will send ann request and add a song to the playlist.. And automatical update the list wit request.html */  
/*
  @Playlistid - required: This is the id to the playlist. Just take the id from the url with php.
  @songId     - required: This is the id the user have set in the input field. <- $('ajaxSongId').get('value')
  @token      - required: This will find the var from the main page. this is a security function <- joomla core.
  @playlistIdField - required: This will set the value to null after submission
  @playlistNameFiel- required: This will set the value ti null after submission

*/

function ajaxNewSave(playlistId, songId, token, playlistIdField, playlistNameField){     
    var urltoupdate = 'index.php?option=com_vombiemusic&task=ajaxNewPlaylistSong&playlist_id='+ playlist_id + '&song_id=' + songId + '&' + token + '=1&format=raw';

    new Request.HTML({
    url: urltoupdate,

      onRequest: function(){
        $('allSongs').set('text', 'loading...' + urltoupdate);
      },

      onComplete: function(response){
        $('allSongs').empty().adopt(response);
        playlistNameField.set('value','');
      }
    //debug to see update url
    //$('message').set('html',urltoupdate);
    }).send()
}

window.addEvent('domready',function() {
  //Load songs.
  updatePlaylist();
});
