$(function (){

    createMarquee({
    
      // auto starts on page load
      autostart: true,
    
      // callback
      onComplete: function(){},
      
      // controls the speed at which the marquee moves
      duration: 30000, 
    
      // right margin between consecutive marquees
      padding: 20, 
    
      // class of the actual div or span that will be used to create the marquee - 
      // multiple marquee items may be created using this item's content. 
      // This item will be removed from the dom
      marquee_class:'.example-marquee', 
    
      // the container div in which the marquee content will animate. 
      container_class: '.example-container', 
    
      // a sibling item to the marqueed item  that affects - 
      // the end point position and available space inside the container. 
      sibling_class: '.example-sibling', 
    
      // Boolean to indicate whether pause on hover should is required. 
      hover: false,
    
      // 0-1
      velocity: 0,
      
      // or right
      direction: 'left'
    
    });
    
    });