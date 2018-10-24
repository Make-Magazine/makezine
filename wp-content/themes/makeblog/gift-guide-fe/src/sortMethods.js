
module.exports = {
   name: {
      asc : function(a,b) {
         //console.log('sorting name asc');
         if (a.item_name.toLowerCase() < b.item_name.toLowerCase())
            return -1;
         if (a.item_name.toLowerCase() > b.item_name.toLowerCase())
            return 1;
         return 0;
      },
      desc : function(a,b) {
         //console.log('sorting name desc');
         if (a.item_name.toLowerCase() > b.item_name.toLowerCase())
            return -1;
         if (a.item_name.toLowerCase() < b.item_name.toLowerCase())
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
            test = aInt - bInt;
         //console.log(aRaw, aInt, bRaw, bInt, test);
         return test;
      },
      desc : function(a,b) {
         //console.log('sorting price asc');
         var aRaw = a.item_price,
            bRaw = b.item_price,
            aInt = Math.floor(parseFloat(aRaw)),
            bInt = Math.floor(parseFloat(bRaw)),
            test = bInt - aInt;
         //console.log(aRaw, aInt, bRaw, bInt, test);
         return test;
      }
   }
}
