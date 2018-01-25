export function timeAgo (time) {
  const between = Date.now() / 1000 - Number(time);
  if (between < 3600) {
    return ~~(between / 60) + ' 分钟';
  } else if (between < 86400) {
    return ~~(between / 3600) + ' 小时';
  } else {
    return ~~(between / 86400) + ' 天';
  }
}
