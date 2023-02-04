
<script>
function rand(size){
    s = [...Array(size).keys()]
    s.sort(() => Math.random() - 0.5);
    return s;
}
</script>