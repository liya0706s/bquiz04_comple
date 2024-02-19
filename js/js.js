// JavaScript Document
function lof(x)
{
	location.href=x
}

// 外部引入，不同頁面間都會用到del function
// 刪除的函數
function del(table,id){
	$.post("./api/del.php",{table,id},()=>{
		location.reload();
	})
} 