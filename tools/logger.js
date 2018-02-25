function Logger (ns) {
  this.ns = ns;
}

Logger.prototype.log = function (message) {
  this.emit('log', message);
};

Logger.prototype.error = function (message) {
  this.emit('error', message);
};

Logger.prototype.warn = function (message) {
  this.emit('warn', message);
};

Logger.prototype.emit = function (method, message) {
  console[method].call(null, `[${this.ns}] ${message}`);
}

module.exports = Logger;
