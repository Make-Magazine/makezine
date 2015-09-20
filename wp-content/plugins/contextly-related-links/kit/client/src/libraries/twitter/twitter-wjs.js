window.twttr = (function(d, s, id) {
  // Embedded tweets on the post may have already loaded Twitter library without
  // an ID we're looking for. So, as soon as the window.twttr.ready() function
  // is defined don't do anything.
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id) || t.ready != null) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));
