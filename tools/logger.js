function Logger (ns) {
  this.ns = ns;
}

Logger.prototype.log = function (message) {
  this.emit('log', message);
};

Logger.prototype.info = function (message) {
  this.emit('info', message);
};

Logger.prototype.error = function (message) {
  console.log('\u0007');
  this.emit('error', message);
};

Logger.prototype.warn = function (message) {
  this.emit('warn', message);
};

Logger.prototype.emit = function (method, message) {
  console[method].call(null, `[${this.prettyMethod(method)}: ${this.ns}] ${message}`);
};

Logger.prototype.prettyMethod = function (m) {
  return m.charAt(0).toUpperCase() + m.slice(1);
}

module.exports = Logger;
