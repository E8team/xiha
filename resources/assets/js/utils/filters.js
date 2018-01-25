import { strLimit } from './utils';

export function timeAgo (time) {
  const between = Date.now() / 1000 - new Date(time).getTime() / 1000;
  if (between < 3600) {
    return ~~(between / 60) >= 0 ? ~~(between / 60) + ' 分钟前' : '刚刚';
  } else if (between < 86400) {
    return ~~(between / 3600) + ' 小时前';
  } else if (between < 2592000) {
    return ~~(between / 86400) + ' 天前';
  } else {
    return time.substring(0, 10);
  }
}

export function limit (str, limt) {
  return strLimit(str, limt);
}
