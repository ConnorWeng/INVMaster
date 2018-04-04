## 一、Phinx的操作流程
> #### 1. 通过git下载代码

> #### 2. 创建数据库配置文件phinx.yml， 在项目目录打开命令窗口，输入命令：
```
vendor/bin/phinx init .
```
          
> #### 3. 创建迁移脚本：

```
vendor/bin/phinx create CreateUser
```

> #### 4. 编写对应的脚本，实现创建或更新数据库表等代码（脚本默认所在的目录为 db/migrations ）

> #### 5. 执行迁移：

```
vendor/bin/phinx migrate -e development
#其中：
# development代表开发环境，
# phinx.yml 可配置多种环境的数据库
```

---

## 二、Phinx的常用命令

> ####  创建迁移：

```
vendor/bin/phinx create CreatUser
# 其中 CreatUser 要采用驼峰式，首字母要大写
```

> #### 执行迁移


```
vendor/bin/phinx migrate -e development

# 指定迁移的文件：
vendor/bin/phinx migrate -e development -t 20110103081132

```


> #### 回滚迁移


```
vendor/bin/phinx rollback -e development

#回滚指定版本的迁移
vendor/bin/phinx rollback -e development -t 20120103083322

#回滚所有版本
vendor/bin/phinx rollback -e development -t 0 -f

```

> #### 查看迁移状态

```
vendor/bin/phinx status -e development

# up 代表已经进行过迁移（创建或更新了数据库表）
# down 表示没有进行过迁移或经历过回滚

```

---

## 三、迁移脚本说明

- [ ] 通过命令 vendor/bin/phinx create CreatUser 会在目录 db/migrations  下生成类似 20180403170315_create_user.php 的脚本

- [ ] 迁移脚本会自带一个change的函数，请将change函数改为up函数

- [ ] 在本地测试时，可以增加dwon函数用于填写回滚操作，但是在提交线上时，请将down函数删掉，避免线上误操作回滚造成数据丢失


---

## 四、迁移的规范

- [ ] 迁移脚本提交到线上后，强烈建议不要再对该文件进行修改，也不要对该迁移进行回滚操作

- [ ] 如果确实有需要对该迁移进行回滚，请使用“向前回滚”的方式，即创建新的迁移脚本，在其配置相反的操作

- [ ] 避免降级的操作，如 删除表、删除字段等

- [ ] 避免修改的操作，如 修改表名，修改字段名等

- [ ] 建议采用新增操作，如 新增迁移脚本、新增表、新增字段等

>  总结：
> - 迁移脚本只保留up函数
> - 尽量对数据库只做新增操作，不做降级和修改的操作
> - 通过创建反向操作的迁移脚本实现回滚
 

---


## 五、迁移脚本的代码说明

> **例子**：**创建数据库表**：

```
$this->table('inv_user', array('id'=>'user_id','collation' => 'utf8mb4_unicode_ci','comment'=>'用户表'))
        
    ->addColumn('open_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'微信用户id'))
    ->addColumn('nick_name', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'昵称'))
    ->addColumn('avatar_url', 'string', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'用户头像'))
    ->addColumn('gender', 'integer', array('limit' => MysqlAdapter::INT_TINY,'default'=>0,'signed'=>false,'comment'=>'性别（0为未知，1为男，2为女）')) 
    ->addColumn('phone', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'电话'))
    ->addColumn('city', 'string' array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'所在城市'))
    ->addColumn('province', 'string', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'省'))
    ->addColumn('country', 'string', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'国家'))

    ->save();
```

- ### 关于字段
> 通过对象addColumn增加字段，如增加 “国家” 字段

```
addColumn('country', 'string', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'国家'))
```

> 解析： addColumn(字段，类型，约束相关数组)
    
    1. 字段常用类型：integer、string、text、decimal
    
    2. 常用约束数组键：
        ++ 默认值 default 如：'default'=>''
	    ++ 字段长度 limit 如：'limit' => 60
	    ++ 字符集排序 collation 如：'collation'=>'utf8mb4_unicode_ci'
	    ++ 注释 comment 如：'comment'=>'国家'
	    ++ 是否为有符号整型 signed 如：'signed'=>false
	    ++ decimal的精度和小数位数 precision ,scale 如：'precision' => 5,'scale'=> 2 (最大为 999.99)


- ### 关于表
> 通过 对象table 来指定表，如

```
table('inv_user', array('id'=>'user_id','collation' => 'utf8mb4_unicode_ci','comment'=>'用户表'))
```

> 解析： table(表名，约束相关数组)
    
    1. 创建表时会自动新增一个id主键字段，无需再通过 addColumn 来创建主键字段
    
    2. 上例的 数组 内的 'id'=>'user_id' 表示主键更名为user_id
    
    
    

---

## 六、Phinx 的详细文档

更详细的说明，如索引的添加、外键的添加、表名的更改、字段名的更改等

请参考phinx的相关文档：

> [中文版](https://tsy12321.gitbooks.io/phinx-doc/content/)

> [英文版](http://docs.phinx.org/en/latest/)