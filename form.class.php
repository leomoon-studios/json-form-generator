<?php
/**
 * JSON Form Generator
 * HTML Form Generator from JSON format
 *
 * @author Arash Soleimani <arash@leomoon.com>
 * @package json_form_generator
 * @version 1.0
 * 
 */
class Form {
    public $json;
    public $method = "post";
    public $action = "./";
    public $html = "";
    /**
     * Class Constructor
     * @param array $param ['file'=>YourFilePath, 'json'=>'json string']
     * 
     * @example
     * <code>
     *   $form = new Form(['file'=>'./example_form.json']);
     * </code>
     */
    function __construct($params){
        if(isset($params['json'])){
            $this->json = json_decode($params['json'], true);
        }else{
            $this->load($params['file']);
        }
    }
	/**
     * Parse field array (Specifies the generator function based on the type)
     * 
     * @param array $data
     * 
     * @return string
     */
    private function parse($data){
        $inputTypes = ['checkbox','color','date','datetime-local','email','file','hidden','image','month','number','password','radio','range','reset','search','submit','tel','text','time','url','week'];
        if(in_array($data['type'], $inputTypes)){
            return $this->input($data);
        }else{
            return $this->{$data['type']}($data);
        }
    }
    /**
     * Load json file
     * 
     * @param string $filePath
     * 
     * @return array
     */
    public function load($filePath){
        $data = json_decode(file_get_contents($filePath), true);
        
        if($data){
            $this->json = $data;
            
        }else{
            $this->errorMessage = "File not found";
        }
    }
    /**
     * Generate Input tag
     * 
     * @param array $data {
     *                     name, title, type, id, value, autocomplete, min, max, minlength, pattern, 
     *                     onclick, onchange, checked, required, disabled, readonly, autofocus, 
     *                     multiple, dir, class, step, size
     *                     }
     * 
     * @return string
     */
    public function input($data){
        $tag = '<label for="'.$data['name'].'">'.$data['title']."</label>";
        $tag .= '<input name="'.$data['name'].'" ';
        if(isset($data['type'])) $tag .= ' type="'.$data['type'].'"';
        if(isset($data['id'])) $tag .= ' id="'.$data['id'].'"';
        if(isset($data['value'])) $tag .= ' value="'.$data['value'].'"';
        if(isset($data['autocomplete'])) $tag .= ' autocomplete="'.$data['autocomplete'].'"';
        if(isset($data['min'])) $tag .= ' min="'.$data['min'].'"';
        if(isset($data['max'])) $tag .= ' max="'.$data['max'].'"';
        if(isset($data['minlength'])) $tag .= ' minlength="'.$data['minlength'].'"';
        if(isset($data['placeholder'])) $tag .= ' placeholder="'.$data['placeholder'].'"';
        if(isset($data['pattern'])) $tag .= ' pattern="'.$data['pattern'].'"';
        if(isset($data['size'])) $tag .= ' size="'.$data['size'].'"';
        if(isset($data['step'])) $tag .= ' step="'.$data['step'].'"';     
        if(isset($data['onClick'])) $tag .= ' onclick="'.$data['onClick'].'"';
        if(isset($data['onChange'])) $tag .= ' onchange="'.$data['onChange'].'"';
        if(isset($data['required'])) $tag .= ' required';
        if(isset($data['checked'])) $tag .= ' checked';
        if(isset($data['disabled'])) $tag .= ' disabled';
        if(isset($data['readonly'])) $tag .= ' readonly';
        if(isset($data['autofocus'])) $tag .= ' autofocus';
        if(isset($data['multiple'])) $tag .= ' multiple';
        if(isset($data['dir'])) $tag .= ' dir="'.$data['dir'].'"';
        if(isset($data['class'])) $tag .= ' class="'.$data['class'].'"';
        $tag .= " />";

        return $tag;
    }
    /**
     * Generate Select tag
     * 
     * @param array $data {
     *                      name, title, class, id, required, disabled, readonly, autofocus,
     *                      onclick, onchange,
     *                      options =>{
     *                                  'key1'=>'value1',
     *                                  'key2'=>'value2'
     *                                }
     *                    }
     * 
     * @return string
     */
    public function select($data){
        $tag = '<label for="'.$data['name'].'">'.$data['title']."</label>";
        $tag .= '<select name="'.$data['name'].'" ';
        if(isset($data['class'])) $tag .= ' class="'.$data['class'].'"';
        if(isset($data['id'])) $tag .= ' id="'.$data['id'].'"';
        if(isset($data['onClick'])) $tag .= ' onclick="'.$data['onClick'].'"';
        if(isset($data['onChange'])) $tag .= ' onchange="'.$data['onChange'].'"';
        if(isset($data['required'])) $tag .= ' required';
        if(isset($data['disabled'])) $tag .= ' disabled';
        if(isset($data['readonly'])) $tag .= ' readonly';
        if(isset($data['autofocus'])) $tag .= ' autofocus';
        $tag .= '>';
            if(isset($data['options'])){
                foreach($data['options'] as $key=>$value){
                    $tag .= '<option value="'.$key.'">'.$value.'</option>';
                }
            }
        $tag .= '</select>';

        return $tag;
    }
    /** 
     * Generate Textarea tag 
     * 
     * @param array $data {
     *                      name, title, onclick, onchange, required, disabled, 
     *                      readonly, autofocus, placeholder, value
     *                    }
     * 
     * @return string
    */
    public function textarea($data){
        $tag = '<label for="'.$data['name'].'">'.$data['title']."</label>";
        $tag .= '<textarea name="'.$data['name'].'" ';
        if(isset($data['onClick'])) $tag .= ' onclick="'.$data['onClick'].'"';
        if(isset($data['onChange'])) $tag .= ' onchange="'.$data['onChange'].'"';
        if(isset($data['required'])) $tag .= ' required';
        if(isset($data['disabled'])) $tag .= ' disabled';
        if(isset($data['readonly'])) $tag .= ' readonly';
        if(isset($data['autofocus'])) $tag .= ' autofocus';
        if(isset($data['placeholder'])) $tag .= ' placeholder="'.$data['placeholder'].'"';
        $tag .= " >";
        if(isset($data['value'])) $tag .= $data['value'];
        $tag .= "</textarea>";

        return $tag;

    }
    /**
     * Generate Button tag
     * 
     * @param array $data {
     *                      name, class, id, disabled, autofocus, value
     *                    }
     * 
     * @return string
     */
    public function button($data){
        $tag = '<button name="'.$data['name'].'" ';
        if(isset($data['class'])) $tag .= ' class="'.$data['class'].'"';
        if(isset($data['id'])) $tag .= ' id="'.$data['id'].'"';
        if(isset($data['onClick'])) $tag .= ' onclick="'.$data['onClick'].'"';
        if(isset($data['disabled'])) $tag .= ' disabled';
        if(isset($data['autofocus'])) $tag .= ' autofocus';
        $tag .= ">".$data['title'];
        $tag .= '</button>';

        return $tag;

    }
    /**
     * Render HTML tags from JSON
     * 
     * @return string
     */
    public function render(){
        $data = $this->json;
        
        $this->html = '<form name="'.$data['name'].'" method="'.$data['method'].'" action="'.$data['action'].'"';
        
        if($data['enctype']){ $this->html .= ' enctype="'.$data['enctype'].'"'; }
        if($data['target']){ $this->html .= ' target="'.$data['target'].'"'; }
        if($data['autocomplete']){ $this->html .= ' autocomplete="'.$data['autocomplete'].'"'; }
        
        $this->html .= '>';
        
        foreach($data['properties'] as $value){
            $this->html .= $this->parse($value);
        }
        $this->html .= "</form>";
        return $this->html;
    }
    /**
     * Print generated form
     * 
     */
    public function show(){
        echo $this->render();
    }
    /**
     * Show errors
     */
    public function error(){
        echo $this->errorMessage."\r\n";
    }
}

?>