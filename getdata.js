var params = {
  key: "1kekecMN31fxge0j"
};

$.getJSON('http://api.asg.northwestern.edu/courses/?key=YOUR_KEY&term=4560&subject=SPANISH', params, function(data) {
  // data is the JavaScript array that results from parsing the response
  console.log(data);
});

