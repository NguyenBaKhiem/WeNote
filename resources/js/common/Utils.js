export default {

  trimEndZero(value) {
    const dot = '.';
    const strValue = `${value}`;
    if (strValue.indexOf(dot) === -1) {
      return strValue;
    }
    const trimEndZero = window._.trimEnd(strValue, '0');
    return window._.trimEnd(trimEndZero, dot);
  }
}
