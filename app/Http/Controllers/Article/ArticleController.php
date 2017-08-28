<?php

namespace App\Http\Controllers\Article;

use App\Service\ArticleService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $Article;

    public function __construct(ArticleService $article)
    {
        $this->Article=$article;
    }

    //首页
    public function index()
    {
        $data['articleList']=$this->Article::articleList();
        $data['articleTypeList']=$this->Article::articleTypeList();
        return view('Article.index',$data);
    }

    //发表文章
    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationData($request);
            $data=$request->input('article');
            $data['face'] = empty($request->file('face'))||is_null($this->upArticleFace($request->file('face'))) ? '' : $this->upArticleFace($request->file('face'));
           /* $data['tag']=implode(",",$data['tag']);*/
            if($this->Article::create($data))
            {
                return redirect('/article')->with('success','发表成功！');
            }else{
                return redirect()->back()->with('error','发表失败！');
            }
        }
        $data['articleTypeList']=$this->Article::articleEnableTypeList();
        return view('Article.create',$data);
    }

    //上传封面
    public function upArticleFace($file)
    {
        if($file->isValid()){
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;// 生成的文件名
            $bool = Storage::disk('ArticleFace')->put($filename, file_get_contents($realPath));
            if($bool){
                return $filename;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    //查看文章
    public function detail($id)
    {
       $data['article'] = $this->Article::getArticleById($id);
       return view('Article.detail',$data);

    }

    //文章筛选
    public function typeSelect($type_id)
    {
        $data['articleList']=$this->Article::typeSelect($type_id);
        $data['articleTypeList']=$this->Article::articleTypeList();
        return view('Article.index',$data);
    }

    //搜索文章
    public function search($content)
    {
        $data['articleList']=$this->Article::search($content);
        $data['articleTypeList']=$this->Article::articleTypeList();
        return view('Article.index',$data);
    }

    //编辑文章状态
    public function editStatus($id)
    {
        if($this->Article::editStatus($id))
        {
            return redirect('/article')->with('success','操作成功！');
        }else{
            return redirect('/article')->with('error','操作失败！');
        }
    }

    //编辑文章
    public function edit($id=null,Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationData($request);
            $data=$request->input('article');
            if($request->file('face'))
            {
                $data['face'] = empty($this->upArticleFace($request->file('face'))) ? '' : $this->upArticleFace($request->file('face'));
            }
           /* $data['tag']=implode(",",$data['tag']);*/
            if($this->Article::edit($id,$data)==0)
            {
                return redirect()->back()->with('error','编辑失败！');
            }else{
                return redirect('/article')->with('success','编辑成功！');
            }
        }
        $data['article']=$this->Article::getArticleById($id);
        $data['articleTypeList']=$this->Article::articleTypeList();
        return view('Article.edit',$data);
    }

    //删除文章
    public function delete($id)
    {
        if($this->Article::delete($id))
        {
            return redirect('/article')->with('success','删除成功！');
        }else{
            return redirect('/article')->with('error','删除失败！');
        }
    }

    //文章参数验证
    public function verificationData($request)
    {
        $this->validate($request, [
            "article.title" => 'required',
            'article.content' => 'required',
            'article.author' => 'required',
            'article.excerpt' => 'required',
            'article.source' => 'required',
            'article.status' => 'required',
            /*'article.tag' => 'required',*/
            'article.type' => 'required'
        ], [
            'required' => ':attribute 为必填项',
            'integer' => ':attribute 必须为整数',
        ], [
            'article.title' => '文章标题',
            'article.content' => '文章内容',
            'article.author' => '文章作者',
            'article.excerpt' => '文章摘要',
            'article.source' => '文章来源',
            'article.status' => '文章状态',
            'article.tag' => '文章标签',
            'article.type' => '文章分类',
        ]);
    }

    //文章参数验证
    public function verificationTypeData($request)
    {
        $this->validate($request, [
            "articleType.name" => 'required',
            'articleType.status' => 'required|integer',
        ], [
            'required' => ':attribute 为必填项',
            'integer' => ':attribute 必须为整数',
        ], [
            'article.name' => '分类名称',
            'article.status' => '分类状态',
        ]);
    }

    //文章分类首页
    public function typeIndex()
    {
        $data['articleTypeList']=$this->Article::articleTypeList();
        return view('Article.typeIndex',$data);
    }

    //编辑文章分类状态
    public function editTypeStatus($id)
    {
        if($this->Article::editTypeStatus($id))
        {
            return redirect('/article/type')->with('success','操作成功！');
        }else{
            return redirect('/article/type')->with('error','操作失败！');
        }
    }

    //编辑文章分类
    public function editType($id=null,Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationTypeData($request);
            $data=$request->input('articleType');
            if($this->Article::editType($id,$data)==0)
            {
                return redirect()->back()->with('error','编辑失败！');
            }else{
                return redirect('/article/type')->with('success','编辑成功！');
            }
        }
        $data['articleType']=$this->Article::getArticleTypeById($id);
        return view('Article.editType',$data);
    }

    //删除文章分类
    public function deleteType($id)
    {
        $result=$this->Article::deleteType($id);
        if(is_array($result))
        {
            $idList=[];
            foreach ($result as $k=>$v)
            {
                $idList[$k]=$v['id'];
            }
            $idList=implode("、",$idList);
            return redirect('/article/type')->with('error','删除失败,因为ID为【'.$idList.'】的文章下正在使用该分类，请先更换对应ID文章的分类,或删除对应的文章后再进行删除！');
        }
        if($result)
        {
            return redirect('/article/type')->with('success','删除成功！');
        }else{
            return redirect('/article/type')->with('error','删除失败！');
        }
    }

    //新增文章分类
    public function createType(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationTypeData($request);
            $data=$request->input('articleType');
            if($this->Article::createType($data))
            {
                return redirect('/article/type')->with('success','新增成功！');
            }else{
                return redirect()->back()->with('error','新增失败！');
            }
        }
        return view('Article.createType');
    }


}
