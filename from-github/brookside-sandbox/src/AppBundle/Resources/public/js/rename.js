// From https://gist.github.com/STRd6/7813942
//
// Thank you Daniel (https://gist.github.com/STRd6)

var f, rename, renamedFunction;

rename = function(fn, name) {
  return Function("fn", "return (function " + name + "(){\n  return fn.apply(this, arguments)\n});")(fn);
};

f = function() {};

renamedFunction = rename(f, "a_new_name");

alert(renamedFunction.name);
