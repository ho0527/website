let split=location.href.split("=")
let key=split[split.length-1]
let ajax=new XMLHttpRequest()

ajax.onreadystatechange=function(){
    document.getElementById("context").innerHTML=this.responseText
}

if(key!="health"&&key!="basketball"&&key!="baseball"&&key!="swimming"&&key!="msgboard"&&key!="reference"){
    key="main"
}

ajax.open("GET",key+".html",true)
ajax.send()

setTimeout(function(){
    if(key=="main"){
        document.querySelectorAll(".contextpng").forEach(function(event){
            event.onclick=function(){
                if(this.id=="png1"){
                    document.getElementById("mainpng").src="material/0202A.png"
                }else if(this.id=="png2"){
                    document.getElementById("mainpng").src="material/0203A.png"
                }else if(this.id=="png3"){
                    document.getElementById("mainpng").src="material/0204A.png"
                }else if(this.id=="png4"){
                    document.getElementById("mainpng").src="material/0205A.png"
                }else{
                    console.log("[ERROR]unknown image")
                }
            }
        })
    }else if(key=="health"){
        document.querySelectorAll(".healthbutton").forEach(function(event){
            event.onclick=function(){
                if(event.value=="健康新知"){
                    document.getElementById("contextmain").innerHTML=`
                        缺乏運動已成為影響全球死亡率的第四大危險因子-國人無規律運動之比率高達72.2%<br>
                        資料來源： 行政院衛生署國民健康局 發佈日期： 2012 / 10 / 07<br>
                        世界衛生組織指出運動不足已成全球第四大致死因素，每年有6%的死亡率與運動不足有關，僅次於高血壓（13％）、菸品使用（9％）及高血糖（6％）之後，有超過200萬死亡人數可歸因於靜態生活。世界上約60-85％的成人過著靜態生活，三分之二的兒童運動不足，未來都將影響健康並造成公共衛生問題。運動不足除了增加死亡率，還會使心血管疾病、糖尿病、肥胖的風險加倍，並增加大腸癌、高血壓、骨質疏鬆、脂質失調症（lipid disorders）、憂鬱、焦慮的風險。大約21-25％乳癌及大腸癌、27%糖尿病與30％的缺血性心臟病，係因運動不足所造成。許多國家運動不足的人口比率，也正不斷地增加，依據行政院體育委員會2011年運動城巿調查結果顯示，國人無規律運動習慣之比率高達72.2%。 我國十大死因的危險因子皆與運動不足有關，運動的好處很多，可以預防慢性疾病，降低罹患癌症、跌倒的風險等。國家衛生研究院溫啟邦教授利用台灣一個大型的追蹤世代，分析各個不同運動量的健康效益。研究發現，與不運動的人相比，每天運動15分鐘(每週約90分鐘)是可以減少14%總死亡、10%癌症死亡及20%的心血管疾病死亡，延長3年壽命。這些好處不但適用於各個年齡層包括年青人、年老人，也適用於男性與女性，對有心血管疾病風險的人包括吸菸、肥胖者，也一樣有用。 國民健康局鼓勵民眾養成規律運動習慣，對於預防心血管疾病、糖尿病、高血脂以及高血壓等，都有顯著的效益，並可降低罹患癌症的風險，加速代謝脂肪，強化肌肉組織與功能，維持健康體重，提高腦內啡的釋放，降低情緒壓力。一般而言，成人只要每週運動累積達150分鐘、兒童每日運動累積60分鐘，就能有足夠的運動量，建議成人每天運動30分鐘，可分段累積運動量，效果與一次做完一樣。例如上下班(學)通勤時間與中午休息時間分段進行，每次15分鐘分2次或是每次10分鐘分3次完成，只要每天持之以恆，健康體能就會大大地提昇。 許多上班族時常抱怨沒時間或空間運動，國民健康局製作15分鐘「上班族健康操」，不受場地、服裝的限制，每天上、下午各跳15分鐘健康操，可消耗100大卡的熱量，持續1年，約可減少4公斤，不但消耗過多熱量，還......
                    `
                }else if(event.value=="菸害防制"){
                    document.getElementById("contextmain").innerHTML=`
                        菸害防制法<br><br>
                        第三章　兒童及少年、孕婦吸菸行為之禁止<br>
                        第12條　未滿十八歲者，不得吸菸。<br>
                        孕婦亦不得吸菸。<br>
                        父母、監護人或其他實際為照顧之人應禁止未滿十八歲者吸菸。<br>
                        第13條　任何人不得供應菸品予未滿十八歲者。<br>
                        任何人不得強迫、引誘或以其他方式使孕婦吸菸。<br>
                        第14條　任何人不得製造、輸入或販賣菸品形狀之糖果、點心、玩具或其他任何物品。<br><br>
                        第四章　吸菸場所之限制<br>
                        第15條　下列場所全面禁止吸菸：<br>
                        一、高級中等學校以下學校及其他供兒童及少年教育或活動為主要目的之場所。<br>
                        二、大專校院、圖書館、博物館、美術館及其他文化或社會教育機構所在之室內場所。<br>
                        三、醫療機構、護理機構、其他醫事機構及社會福利機構所在場所。但老人福利機構於設有獨立空調及獨立隔間之室內吸菸室，或其室外場所，不在此限。<br>
                        四、政府機關及公營事業機構所在之室內場所。<br>
                        五、大眾運輸工具、計程車、遊覽車、捷運系統、車站及旅客等候室。<br>
                        六、製造、儲存或販賣易燃易爆物品之場所。<br>
                        七、金融機構、郵局及電信事業之營業場所。<br>
                        八、供室內體育、運動或健身之場所。<br>
                        九、教室、圖書室、實驗室、表演廳、禮堂、展覽室、會議廳（室）及電梯廂內。<br>
                        十、歌劇院、電影院、視聽歌唱業或資訊休閒業及其他供公眾休閒娛樂之室內場所。<br>
                        十一、旅館、商場、餐飲店或其他供公眾消費之室內場所。但於該場所內設有獨立空調及獨立隔間之室內吸菸室、半戶外開放空間之餐飲場所、雪茄館、下午九時以後開始營業且十八歲以上始能進入之酒吧、視聽歌唱場所，不在此限。<br>
                        十二、三人以上共用之室內工作場所。<br>
                        十三、其他供公共使用之室內場所及經各級主管機關公告指定之場所及交通工具。<br>
                        前項所定場所，應於所有入口處設置明顯禁菸標示，並不得供應與吸菸有關之器物。<br>
                        第一項第三款及第十一款但書之室內吸菸室；其面積、設施及設置辦法，由中央主管機關定之。<br>
                        第16條　下列場所除吸菸區外，不得吸菸；未設吸菸區者，全面禁止吸菸：<br>
                        一、大專校院、圖書館、博物館、美術館及其他文化或社會教育機構所在之室外場所。<br>
                        二、室外體育場、游泳池或其他供公眾休閒娛樂之室外場所。<br>
                        三、老人福利機構所在之室外場所。<br>
                        四、其他經各級主管機關指定公告之場所及交通工具。<br>
                        前項所定場所，應於所有入口處及其他適當地點，設置明顯禁菸標示或除吸菸區外不得吸菸意旨之標示；且除吸菸區外，不得供應與吸菸有關之器物。<br>
                        第一項吸菸區之設置，應符合下列規定：<br>
                        一、吸菸區應有明顯之標示。<br>
                        二、吸菸區之面積不得大於該場所室外面積二分之一，且不得設於必經之處。<br>
                        第17條　第十五條第一項及前條第一項以外之場所，經所有人、負責人或管理人指定禁止吸菸之場所，禁止吸菸。<br>
                        於孕婦或未滿三歲兒童在場之室內場所，禁止吸菸。<br>
                        第18條　於第十五條或第十六條之禁菸場所吸菸或未滿十八歲者進入吸菸區，該場所負責人及從業人員應予勸阻。<br>
                        於禁菸場所吸菸者，在場人士得予勸阻。<br>
                        第19條　直轄市、縣（市）主管機關對第十五條及第十六條規定之場所與吸菸區之設置及管理事項，應定期派員檢查。<br><br>
                        第五章　菸害之教育及宣導<br>
                        第20條　各機關學校應積極辦理菸害防制教育及宣導。<br>
                        第21條　醫療機構、心理衛生輔導機構及公益團體得提供戒菸服務。<br>
                        前項服務之補助或獎勵辦法，由各級主管機關定之。<br>
                        第22條　電視節目、戲劇表演、視聽歌唱及職業運動表演等不得特別強調吸菸之形象。<br><br>
                        第六章　罰則<br>
                        第23條　違反第五條或第十條第一項規定者，處新臺幣一萬元以上五萬元以下罰鍰，並得按次連續處罰。<br>
                        第24條　製造或輸入違反第六條第一項、第二項或第七條第一項規定之菸品者，處新臺幣一百萬元以上五百萬元以下罰鍰，並令限期回收；屆期未回收者，按次連續處罰，違規之菸品沒入並銷毀之。<br>
                        販賣違反第六條第一項、第二項或第七條第一項規定之菸品者，處新臺幣一萬元以上五萬元以下罰鍰。<br>
                        第25條　違反第八條第一項規定者，處新臺幣十萬元以上五十萬元以下罰鍰，並令限期申報；屆期未申報者，按次連續處罰。<br>
                        規避、妨礙或拒絕中央主管機關依第八條第二項規定所為之取樣檢查（驗）者，處新臺幣十萬元以上五十萬元以下罰鍰。<br>
                        第26條　製造或輸入業者，違反第九條各款規定者，處新臺幣五百萬元以上二千五百萬元以下罰鍰，並按次連續處罰。<br>
                        廣告業或傳播媒體業者違反第九條各款規定，製作菸品廣告或接受傳播或刊載者，處新臺幣二十萬元以上一百萬元以下罰鍰，並按次處罰。<br>
                        違反第九條各款規定，除前二項另有規定者外，處新臺幣十萬元以上五十萬元以下罰鍰，並按次連續處罰。<br>
                        第27條　違反第十一條規定者，處新臺幣二千元以上一萬元以下罰鍰。<br>
                        第28條　違反第十二條第一項規定者，應令其接受戒菸教育；行為人未滿十八歲且未結婚者，並應令其父母或監護人使其到場。<br>
                        無正當理由未依通知接受戒菸教育者，處新臺幣二千元以上一萬元以下罰鍰，並按次連續處罰；行為人未滿十八歲且未結婚者，處罰其父母或監護人。<br>
                        第一項戒菸教育之實施辦法，由中央主管機關定之。<br>
                        第29條　違反第十三條規定者，處新臺幣一萬元以上五萬元以下罰鍰。<br>
                        第30條　製造或輸入業者，違反第十四條規定者，處新臺幣一萬元以上五萬元以下罰鍰，並令限期回收；屆期未回收者，按次連續處罰。<br>
                        販賣業者違反第十四條規定者，處新臺幣一千元以上三千元以下罰鍰。<br>
                        第31條　違反第十五條第一項或第十六條第一項規定者，處新臺幣二千元以上一萬元以下罰鍰。<br>
                        違反第十五條第二項、第十六條第二項或第三項規定者，處新臺幣一萬元以上五萬元以下罰鍰，並令限期改正；屆期未改正者，得按次連續處罰。<br>
                        第32條　違反本法規定，經依第二十三條至前條規定處罰者，得併公告被處分人及其違法情形。<br>
                        第33條　本法所定罰則，除第二十五條規定由中央主管機關處罰外，由直轄市、縣（市）主管機關處罰之。
                    `
                }else if(event.value=="癌症防治"){
                    document.getElementById("contextmain").innerHTML=`
                        降低罹癌風險 建構健康生活型態 癌症防治 三管齊下 Part 1 降低罹癌風險建構健康生活型態 撰文：徐文媛　諮詢對象：衛生署國民健康局副局長趙坤郁 致癌的因素很多，而且往往就存在於我們周遭環境及日常生活中。唯有正常飲食、適當運動、遠離致癌因子、養成健康行為與生活習慣，並改善生活環境品質，才能減少罹癌的危機。 形塑健康生活新價值觀 「健康生活型態」牽涉的範圍很廣，衛生署國民健康局副局長趙坤郁表示，做為國家癌症防治政策的一環，應優先選擇具實證研究基礎的指標，所以健康飲食、菸害防制、檳榔防制及建立運動習慣，都是目前積極推動的衛生政策。 生活型態需要長時間建立，所以要改變民眾健康生活型態，必須設定出各項目標策略和衡量指標，設法營造有助達成目標的軟、硬體環境，這些工作往往需要跨部門，甚至從民間社團、社區等基層的參與，才能讓議題逐漸發酵，達到社會價值的建立及風氣的改變。例如在健康飲食方面，至少需要健康局與食品衛生處（未來即將成立的食品藥物管理局）合作，除了宣導正確的飲食習慣，也要為民眾吃的健康把關，避免汙染等有害食物流入巿面。 在推廣動態生活，建立國人運動習慣上，透過訂定國人健康體能指標，調查全國及各縣巿的運動盛行率，並以每年提升0.5%為目標，結合體育主管單位及25縣巿政府同步進行政策的倡議及執行。以最容易、最安全的健走運動為例，現在11 月11日「健走日」已成為許多縣巿政府的重要活動；而去年健康局選擇竹北、屏東、新莊三個縣轄巿，調查健康體能自治性環境的策略指標及調查評估方法，也成為今年體委會要求各縣巿建置運動地圖時的重要參考。 建構健康生活型態是「預防勝於治療」的積極實現，不只能降低罹癌風險，也有助降低其他現代文明病的發生，長期來看是最具經濟效益的健康投資。趙坤郁強調，在全球化浪潮下，我們的飲食、嗜好...等生活型態與西方國家愈來愈趨近，疾病型態也可能逐漸接近，必須及早提出因應措施。<br><br>
                        資料來源：行政院衛生署衛生報導139期 上稿日期：2010/1/20
                    `
                }else{
                    document.getElementById("contextmain").innerHTML=`
                        長期憋尿 泌尿系統問題多<br>
                        資料來源：中央健康保險局雙月刊第98期 上稿日期：2012/08/10 文／游小雯 諮詢／郭育成（台北市立聯合醫院陽明院區泌尿科主任）<br>
                        「憋尿、排尿」這個看似簡單的動作，對身體健康卻有極大的影響，以下4項就是一般人最常憋出問題的病症： 1、尿道感染： 憋尿時，長時間無尿液經過尿道，無法將尿道開口的細菌沖走，大量細菌在尿道聚集，很容易引起發炎，尤其尿流不通暢的人（如前列腺肥大、障礙性排尿或結石），尿道感染的發生率，會比正常人高出許多。 2、膀胱發炎： 憋尿使膀胱長期脹大，膀胱壁血管受到壓迫，膀胱黏膜就會缺血，只要身體抵抗力差時，細菌趁虛而入即造成「急性膀胱炎」。膀胱炎發生時，膀胱壁變得較敏感，儘管積存的尿液不多，也會急著想上廁所，但一次卻只能尿出一點點；而大部份的膀胱炎，尿道粘膜通常也處於發炎狀態，所以會出現「燒灼感」，此外通常還會有「血尿」的情況發生。比較嚴重的膀胱炎甚至會發燒、併發腎臟炎等症狀。 3、前列腺炎與副睪丸炎： 男性若水份攝取不夠或憋尿使排尿次數過少，細菌就有機會透過尿道引發感染；嚴重的話，尿液甚至會經由輸精管倒流至前列腺或副睪丸，而引發前列腺炎或副睪丸炎，最嚴重可導致不孕，增加更多棘手的併發症。 4、膀胱損傷： 長期憋尿會使膀胱過度脹扯、壁肌肉層變薄，如果出現纖維化的情形會影響彈性，導致膀胱收縮力因此變差，而有疼痛、頻尿或尿不乾淨等後遺症；如果神經受損嚴重，膀胱括約肌無力，甚至會造成尿不出來的後果。平日勤保健，別讓憋尿造成終身遺憾許多上班族與公司主管，一忙或開會經常就是好幾個小時，為了不影響進度，常忘了上廁所，即使有尿意也盡量憋著，憋尿不只是造成泌尿系統發炎，尿液回流到腎臟也會造成腎積水引發尿毒症等併發症，最後很可能靠洗腎度日了！ 平日盡量力行以下4項原則： 1、多喝水、不憋尿。 2、注意個人衛生：如多淋浴少盆浴、女生在如廁後記得由前往後擦、性行為前後（不論男女）應注意會陰部、肛門口及尿道口的清潔工作。 3、正常的飲食習慣及充分的休息與睡眠，以增加抵抗力及免疫力。 4、多注意及控制易引發膀胱炎的疾病：如糖尿病、尿路結石、攝護腺肥大等。 如果民眾發現自己解尿不舒服時，一定要在第一時間就診，讓醫師採用檢體對症下藥，只要沒有其他的特殊問題併存，同時能接受完整療程的抗生素治療，通常一星期左右即可痊癒。不過服藥的時間及用量絕對要遵照醫師囑咐，如果自行隨意停藥或不按時服用，很可能會造成殘存的細菌出現抗藥性，非但原本的症狀無法痊癒，還可能帶來慢性泌尿道發炎、尿路結石、腎臟功能受損等併發症，千萬要特別注意。
                    `
                }
            }
        })
    }else{}
},500);