
module.exports = {
   default: function(a,b) {
      console.log('sorting default');
      var aRaw = a.item_list_order,
         bRaw = b.item_list_order,
         aInt = parseInt(aRaw),
         bInt = parseInt(bRaw),
         diff = aInt - bInt;
      console.log(aRaw, aInt, bRaw, bInt, diff);
      if(isNaN(aInt) || isNaN(bInt)) {
         return 1;
      } else {
         return diff;
      }
   },
   name: {
      asc : function(a,b) {
         //console.log('sorting name asc');
         if (a.title.toLowerCase() < b.title.toLowerCase())
            return -1;
         if (a.title.toLowerCase() > b.title.toLowerCase())
            return 1;
         return 0;
      },
      desc : function(a,b) {
         //console.log('sorting name desc');
         if (a.title.toLowerCase() > b.title.toLowerCase())
            return -1;
         if (a.title.toLowerCase() < b.title.toLowerCase())
            return 1;
         return 0;
      }
   },
   price: {
      asc : function(a,b) {
         //console.log('sorting price asc');
         var aRaw = a.item_price,
            bRaw = b.item_price,
            aInt = Math.floor(parseFloat(aRaw)),
            bInt = Math.floor(parseFloat(bRaw)),
            diff = aInt - bInt;
         //console.log(aRaw, aInt, bRaw, bInt, diff);
         return diff;
      },
      desc : function(a,b) {
         //console.log('sorting price asc');
         var aRaw = a.item_price,
            bRaw = b.item_price,
            aInt = Math.floor(parseFloat(aRaw)),
            bInt = Math.floor(parseFloat(bRaw)),
            diff = bInt - aInt;
         //console.log(aRaw, aInt, bRaw, bInt, diff);
         return diff;
      }
   }
}
