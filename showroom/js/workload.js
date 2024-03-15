class Workload {
        updateWorkload() {
                // update every 2 minutes the status of the utilization
                this.intervalGetWorkload(20);
        };
        intervalGetWorkload(seconds) {
                this.updateImgSrc();
                var fetchTimer = setInterval(() => {
                        this.updateImgSrc();
                }, seconds * 1000);
        };
        updateImgSrc() {
                var d = new Date().getTime();
                var imgEl = document.getElementById("workloadimg");
                if (imgEl !== null) {
                        imgEl.src="php/workloadimg.php?d=" + d;
                }
        }
}