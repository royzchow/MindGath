<style>
#scroll {
    height:400px;
    overflow:scroll;
}
</style>

<div id="scroll">
a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>a<br>
</div>

<script>
var objDiv = document.getElementById("scroll");
objDiv.scrollTop = objDiv.scrollHeight;
</script>
