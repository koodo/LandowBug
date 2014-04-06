<?php

/**
 * The model file of file module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     file
 * @version     $Id: model.php 4976 2013-07-02 08:15:31Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php

class fileModel extends model {

    public $savePath = '';
    public $webPath = '';
    public $now = 0;

    /**
     * Construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->now = time();
        $this->setSavePath();
        $this->setWebPath();
    }

    /**
     * Get files of an object.
     * 
     * @param  string   $objectType 
     * @param  string   $objectID 
     * @access public
     * @return array
     */
    public function getByObject($objectType, $objectID) {
        return $this->dao->select('*')->from(TABLE_FILE)->where('objectType')->eq($objectType)->andWhere('objectID')->eq((int) $objectID)->orderBy('id')->fetchAll();
    }

    /**
     * Get info of a file.
     * 
     * @param  int    $fileID 
     * @access public
     * @return object
     */
    public function getById($fileID) {
        $file = $this->dao->findById($fileID)->from(TABLE_FILE)->fetch();
        $file->webPath = $this->webPath . $file->pathname;
        $file->realPath = $this->app->getAppRoot() . "www/data/upload/{$this->app->company->id}/" . $file->pathname;
        return $file;
    }

    /**
     * Save upload.
     * 
     * @param  string $objectType 
     * @param  string $objectID 
     * @param  string $extra 
     * @access public
     * @return array
     */
    public function saveUpload($objectType = '', $objectID = '', $extra = '') {
        $fileTitles = array();
        $now = helper::today();
        $files = $this->getUpload();

        if ($files !== false) {
            foreach ($files as $id => $file) {
                if ($file['size'] == 0)
                    continue;
                move_uploaded_file($file['tmpname'], $this->savePath . $file['pathname']);
                $file['objectType'] = $objectType;
                $file['objectID'] = $objectID;
                $file['addedBy'] = $this->app->user->account;
                $file['addedDate'] = $now;
                $file['extra'] = $file['error'];
                
                unset($file['error']);
                unset($file['tmpname']);
                $this->dao->insert(TABLE_FILE)->data($file)->exec();
                $fileTitles[$this->dao->lastInsertId()] = $file['title'];
            }
        }
        return $fileTitles;
    }

    private function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    /**
     * Get counts of uploaded files.
     * 
     * @access public
     * @return int
     */
    public function getCount() {
        return count($this->getUpload());
    }

    /**
     * Get info of uploaded files.
     * 
     * @param  string $htmlTagName 
     * @access public
     * @return array
     */
    public function getUpload($htmlTagName = 'files') {
        $files = array();
        $file = array(); // tmp array
        if (!isset($_FILES[$htmlTagName]) || !is_array($_FILES[$htmlTagName]))
            return false;
        /* If the file var name is an array. */

        foreach ($_FILES[$htmlTagName]['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK && $_FILES[$htmlTagName]['size'][$key] != 0) {
                $file['extension'] = $this->getExtension($_FILES[$htmlTagName]['name'][$key]);
                $file['pathname'] = $this->setPathName($key, $file['extension']);
                $file['title'] = $_FILES[$htmlTagName]['name'][$key];
                $file['size'] = $_FILES[$htmlTagName]['size'][$key];
                $file['error'] = $_FILES[$htmlTagName]['error'][$key];
                $file['tmpname'] = $_FILES[$htmlTagName]['tmp_name'][$key];
                $files[] = $file;
            }
        }

        return $files;
    }

    /* public function getUpload($htmlTagName = 'files') {
      $files = array();
      if (!isset($_FILES[$htmlTagName]) || !is_array($_FILES[$htmlTagName]))
      return false;
      /* If the file var name is an array.
      if (is_array($_FILES[$htmlTagName]['name'])) {
      extract($_FILES[$htmlTagName]);
      foreach ($name as $id => $filename) {
      if (empty($filename))
      continue;
      $file['extension'] = $this->getExtension($filename);
      $file['pathname'] = $this->setPathName($id, $file['extension']);
      $file['title'] = $filename;
      $file['size'] = $size[$id];
      $file['tmpname'] = $tmp_name[$id];
      $files[] = $file;
      }
      } else {
      if (empty($_FILES[$htmlTagName]['name']))
      return $files;
      extract($_FILES[$htmlTagName]);
      $file['extension'] = $this->getExtension($filename);
      $file['pathname'] = $this->setPathName(0, $file['extension']);
      $file['title'] = $name;
      $file['size'] = $size;
      $file['tmpname'] = $tmp_name;
      return array($file);
      }
      return $files;
      } */

    /**
     * Get extension of a file.
     * 
     * @param  string    $filename 
     * @access public
     * @return string
     */
    public function getExtension($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (strpos($this->config->file->dangers, $extension) !== false)
            return 'txt';
        return $extension;
    }

    /**
     * Set path name of the uploaded file to be saved.
     * 
     * @param  int    $fileID 
     * @param  string $extension 
     * @access public
     * @return string
     */
    public function setPathName($fileID, $extension) {
        $sessionID = session_id();
        $randString = substr($sessionID, mt_rand(0, strlen($sessionID) - 5), 3);
        return date('Ym/dHis', $this->now) . $fileID . mt_rand(0, 10000) . $randString . '.' . $extension;
    }

    /**
     * Set save path.
     * 
     * @access public
     * @return void
     */
    public function setSavePath() {
        $savePath = $this->app->getAppRoot() . "www/data/upload/{$this->app->company->id}/" . date('Ym/', $this->now);
        if (!file_exists($savePath)) {
            @mkdir($savePath, 0777, true);
            touch($savePath . 'index.html');
        }
        $this->savePath = dirname($savePath) . '/';
    }

    /**
     * Set the web path of upload files.
     * 
     * @access public
     * @return void
     */
    public function setWebPath() {
        $this->webPath = $this->app->getWebRoot() . "data/upload/{$this->app->company->id}/";
    }

    /**
     * Insert the set image size code.
     * 
     * @param  string    $content 
     * @param  int       $maxSize 
     * @access public
     * @return string
     */
    public function setImgSize($content, $maxSize = 0) {
        return str_replace('src="data/upload', 'onload="setImageSize(this,' . $maxSize . ')" src="data/upload', $content);
    }

    /**
     * Replace a file.
     *
     * @access public
     * @return bool
     */
    public function replaceFile($fileID, $postName = 'upFile') {
        if ($files = $this->getUpload($postName)) {
            $file = $files[0];
            $filePath = $this->dao->select('pathname')->from(TABLE_FILE)->where('id')->eq($fileID)->fetch();
            $pathName = $filePath->pathname;
            $realPathName = $this->savePath . $pathName;
            if (!is_dir(dirname($realPathName)))
                mkdir(dirname($realPathName));
            move_uploaded_file($file['tmpname'], $realPathName);

            $fileInfo->addedBy = $this->app->user->account;
            $fileInfo->addedDate = helper::now();
            $fileInfo->size = $file['size'];
            $this->dao->update(TABLE_FILE)->data($fileInfo)->where('id')->eq($fileID)->exec();
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Paste image in kindeditor at firefox and chrome. 
     * 
     * @param  string    $data 
     * @access public
     * @return string
     */
    public function pasteImage($data) {
        $data = str_replace('\"', '"', $data);

        ini_set('pcre.backtrack_limit', strlen($data));
        preg_match_all('/<img src="(data:image\/(\S+);base64,(\S+))" .+ \/>/U', $data, $out);
        foreach ($out[3] as $key => $base64Image) {
            $imageData = base64_decode($base64Image);

            $file['extension'] = $out[2][$key];
            $file['pathname'] = $this->setPathName($key, $file['extension']);
            $file['size'] = strlen($imageData);
            $file['addedBy'] = $this->app->user->account;
            $file['addedDate'] = helper::today();
            $file['title'] = basename($file['pathname']);

            file_put_contents($this->savePath . $file['pathname'], $imageData);
            $this->dao->insert(TABLE_FILE)->data($file)->exec();

            $data = str_replace($out[1][$key], $this->webPath . $file['pathname'], $data);
        }

        return $data;
    }

}
