package controllers

import (
	"fmt"
	"html/template"
	"io/ioutil"
	"math"
	"os"
	"path"
	"path/filepath"
	"runtime"

	"github.com/revel/revel"
	"github.com/xiaoxiayu/famemodels.cn/app"

	_ "github.com/mattn/go-sqlite3"
)

type App struct {
	*revel.Controller
}

func (c App) Index() revel.Result {
	model_cnt := app.GetModelCount()
	blueimp_gallery_page := `blueimp.Gallery([`
	for m_i := 1; m_i <= model_cnt; m_i++ {
		model_name := app.GetModelNameBySequence(m_i)
		blueimp_gallery_page += fmt.Sprintf(`
						{
			                title: 'MODEL',
			                href: '/public/modeldetail/model_%s_detail.html',
			                type: 'text/html'
			            },`, model_name)
	}
	blueimp_gallery_page = blueimp_gallery_page[:len(blueimp_gallery_page)-1]
	blueimp_gallery_page += `])`

	js_blueimp_gallery_page := template.JS(blueimp_gallery_page)
	return c.Render(js_blueimp_gallery_page)
}

func getFilelist(path string) []string {
	var getfiles []string
	err := filepath.Walk(path, func(path string, f os.FileInfo, err error) error {
		if f == nil {
			return err
		}
		if f.IsDir() {
			return nil
		}
		println(path)
		getfiles = append(getfiles, path)
		return nil
	})
	if err != nil {
		fmt.Printf("filepath.Walk() returned %v\n", err)
	}
	return getfiles
}

func (c App) ModelGallery(name string) revel.Result {
	public_path := app.G_CFG.PublicPathUnix
	if runtime.GOOS == "windows" {
		public_path = app.G_CFG.PublicPathWin
	}
	model_imgs := getFilelist(path.Join(public_path, "img", name))
	img_str := ""
	for _, model_img := range model_imgs {
		img_str += fmt.Sprintf(`
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		        <div class="hovereffect">
		            <a name="gallery-a" href="/%s" title="%s" data-gallery>
		                <img class="img-responsive" src="/%s" alt="%s" >
		            </a>
		            <div class="overlay">
		                <h2>%s</h2>
		                <p class="icon-links">
		                    <a href="http://twitter.com/share?url=http://www.famemodels.cn/%s">
		                        <span class="fa fa-twitter"></span>
		                    </a>
		                    <a href="http://www.facebook.com/sharer/sharer.php?u=http://www.famemodels.cn/%s">
		                        <span class="fa fa-facebook"></span>
		                    </a>
		                    <a href="https://plus.google.com/share?url=http://www.famemodels.cn/%s">
		                        <span class="fa fa-google-plus"></span>
		                    </a>
		                </p>
		            </div>
		        </div>
		    </div>
			`, model_img, name, model_img, name, name, model_img, model_img, model_img)
	}
	img_html := template.HTML(img_str)

	return c.Render(name, img_html)
}

func (c App) CreateModelInfoHtml(name string) revel.Result {
	model_data := app.GetModelsInfo(name)
	fmt.Println(name)
	fmt.Println(model_data)
	var d1 = []byte(fmt.Sprintf(app.G_model_detail_html,
		name,
		name,
		name,
		name,
		model_data.Location))
	err2 := ioutil.WriteFile(path.Join(revel.BasePath, "public", "modeldetail", fmt.Sprintf("model_%s_detail.html", name)), d1, 0666)
	if err2 != nil {
		fmt.Println(err2.Error())
		return c.RenderJson(0)
	}
	return c.RenderJson(1)
}

func (c App) LoadPortfolioContent(name string) revel.Result {
	//fmt.Println("Model Name:", name)
	model_data := app.GetModelsInfo(name)
	//fmt.Println(model_data)

	res_str := fmt.Sprintf(`
					<div class="panel panel-default" style="border:none;" id="model-detail-container">
					<div class="panel-body">
	                <div class="row">
	                    <HR style=" FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#000000,direction:1145,strength:2); "
	                         color=#987cb9 SIZE=1>
	                    <div class="col-md-4" style="float:left;text-align: left">
	                        <h3><a href="javascript:void(0);" style="text-decoration: none;"><i class="icon-chevron-left"></i>Previous</a></h3>
	                    </div>
	                    <div class="col-md-4" style="float:left;text-align: center;margin-left: -7px" id="info-close">
	                        <a href="javascript:void(0);" style="text-decoration: none;"><h3 class="glyphicon glyphicon-remove"></h3></a>
	                        <!--<h3><a><span class="glyphicon glyphicon-remove"></span>&times;</a></h3>-->

	                    </div>
	                    <div class="col-md-4" style="float:left;text-align: right;margin-left: -7px">
	                        <h3><a href="javascript:void(0);" style="text-decoration: none;">Next<i class="icon-chevron-right"></i></a></h3>

	                    </div>
	                    <HR style=" FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#000000,direction:1145,strength:2); "
	                         color=#987cb9 SIZE=1>

	                    <div class="col-md-12" id="portfolio-ajax-content-container">

	                        <div class="layout-half" id="portfolio-content">
								<div class="thumb">
	                                <img src="/public/img/%s/detail.jpg"
	                                     class="attachment-thumb-600-crop wp-post-image"
	                                     alt="2013_03_08_12_03_13_dla_niego_ochnik_wiosna_lato_2013 - Kopia - Kopia - Kopia - Kopia">
	                            </div>
	                            <!-- .thumb -->
	                            <div class="details">
	                                <h3>%s</h3>

	                                <div class="desc">
	                                    <p>%s</p>

	                                </div>
	                                <!-- .desc -->
	                                <div class="info">
	                                    <ul>
	                                        <li><i class="icon-user"></i><label >Model Name:</label> <span
	                                                class="prop">%s</span>
	                                        </li>
	                                        <li><i class="icon-map-marker"></i><label >Location:</label> <span
	                                                class="prop">%s</span></li>

	                                    </ul>
	                                </div>
	                                <!-- .info -->
	                                <div class="launch">
	                                    <a class="btn-launch" href="#"
	                                       target="_self">Gallery</a>
	                                </div>
	                                <!-- .wi-button -->
	                            </div>
	                            <!-- .details -->
								 </div>
	                        <!-- #portfolio-content -->
	                    </div>

	                </div>
	            </div>
	        </div>
			`, name, name, model_data.Info, name, model_data.Location)
	return c.RenderJson(res_str)
}

func (c App) ModelPortfolio(page, state int) revel.Result {
	//fmt.Println("PAGE:", page)
	model_cnt := app.GetModelCount()
	page_cnt := float64(float64(model_cnt) / 6.0)
	page_cnt = math.Ceil(page_cnt)
	if page_cnt == 0 {
		page_cnt = 1
	}

	if page > int(page_cnt) || page <= 0 {
		return c.RenderJson("")
	}

	var pagebar_str string
	if page == 1 {
		pagebar_str = `
	      <li><span class='page-number'>1</span></li>
		`
	} else {
		pagebar_str = fmt.Sprintf(`<li><a class="prev page-number" id="%d" href="javascript:void(0);"> <i class="icon-angle-left"></i>Previous</a></li>`, page-1)
		pagebar_str += `
	      <li><a class="page-number" id="1" href="javascript:void(0);">1</a></li>
		`
	}

	for page_i := 2; page_i <= int(page_cnt); page_i++ {
		if page_i == page {
			pagebar_str += fmt.Sprintf(`<li><span class="page-number current" id="%d">%d</span></li>`, page_i, page_i)
		} else {
			pagebar_str += fmt.Sprintf(`<li><a class="page-number" id="%d" href="javascript:void(0);">%d</a></li>`, page_i, page_i)
		}
	}
	next_page := page + 1
	if next_page <= int(page_cnt) {
		pagebar_str += fmt.Sprintf(`<li><a class="next page-number" id="%d" href="javascript:void(0);">Next <i class="icon-angle-right"></i></a></li>`, next_page)

	}

	sequence := (page - 1) * 6

	model_datas := app.GetModelsName(sequence, 6)
	model_portfolio_str := ""
	for _, model_data := range model_datas {
		model_html := fmt.Sprintf(`
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mimg">
                    <div class="ih-item square effect8 ">
                        <a name="gallery-a" href="javascript:void(0);" title="%s">
                            <div class="img">
								<img class="img" src="/public/img/%s/index.jpg">
							</div>
                            <div class="info" id="model-info" alt="%d">
                                <h3>%s</h3>
                                <p>FOREIGN MODELS</p>
                            </div>
                        </a>
                    </div>
                </div>`, model_data.Name, model_data.Name, app.GetSequenceFromName(model_data.Name), model_data.Name)
		model_portfolio_str += model_html
	}

	res_str := model_portfolio_str + "|" + pagebar_str
	return c.RenderJson(res_str)
}
