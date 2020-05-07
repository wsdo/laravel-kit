<?php
namespace App\Common;

class ErrorCode{
  const OK = 0;
  //数据格式不正确
  const INVALID_DATA = 10001;
  //修改参数不正确
  const INVALID_UPDATE_DATA = 10002;
  //创建数据不正确
  const INVALID_CREATE_DATA = 10003;
  //保存成功
  const SAVE_OK = 0;
  //保存失败
  const SAVE_ERROR = 20001;

  //找不到数据
  const NO_DATA = 30001;

  //登录未通过验证
  const NOT_PASS = 40000;
  //未登录
  const GUEST = 40001;
  //token 黑名单
  const BLACK_TOKEN = 40002;
  //token 过期
  const EXPIRE_TOKEN = 40003;
  //refresh 过期
  const EXPIE_REFRESH_TOEKN = 40004;
  //创建用户失败
  const CREATE_USER_FAIL = 40005;
}