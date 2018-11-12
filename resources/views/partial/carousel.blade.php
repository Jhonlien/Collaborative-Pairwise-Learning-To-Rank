<div class="slider">
  <ul class="slides">
    <li>
      <img src="{{ asset('img/slide-001.jpg') }}"> 
      <div class="caption center-align">
        <h3>Your</h3>
        <h5 class="light grey-text text-lighten-3">Recommendation Anime</h5>
      </div>
    </li>
    <li>
      <img src="{{ asset('img/slide-001.jpg') }}"> 
      <div class="caption left-align">
        <h3>Your</h3>
        <h5 class="light grey-text text-lighten-3">Recommendation Anime</h5>
      </div>
    </li>
    <li>
      <img src="{{ asset('img/slide-001.jpg') }}"> 
      <div class="caption right-align">
        <h3>Your</h3>
        <h5 class="light grey-text text-lighten-3">Recommendation Anime</h5>
      </div>
    </li>
    <li>
      <img src="{{ asset('img/slide-001.jpg') }}">
      <div class="caption left-align">
        <h3>Your</h3>
        <h5 class="light grey-text text-lighten-3">Recommendation Anime</h5>
      </div>
    </li>
  </ul>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.slider').slider();
    $('.slider').height(400);
    $('.slides').height(400);
  })
 
</script>