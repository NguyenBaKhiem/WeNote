import zlib from 'browserify-zlib';
import buffer from 'buffer';

export default {

  saveItem(key, value) {
    try {
      const zipData = zlib.gzipSync(JSON.stringify(value)).toString('base64');
      window.localStorage.setItem(key, zipData);
    } catch(err) {
      window.app.$broadcast('EVENT_COMMON_ERROR', err);
    }
  },

  getItem(key) {
    const zipData = window.localStorage.getItem(key);
    if (!zipData) {
      return zipData;
    }
    const buf = buffer.Buffer.from(zipData, 'base64');
    const unzipData = zlib.unzipSync(buf).toString();
    return JSON.parse(unzipData);
  },

  removeItem(key) {
    window.localStorage.removeItem(key);
  }
}
