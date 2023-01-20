export default class Recorder {

    static async init(constraints,videoElement) {
        try {
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            this.handleStream(stream, videoElement);
        } catch (e) {
            console.error('error occurs', e);
        }
    }

    static handleStream(stream, videoElement) {
        window.stream = stream;
        videoElement.srcObject = stream;
    }

    static record(elementId, screen = false, camera = false, audio = false) {
        const videoElement = document.querySelector(`video#${elementId}`);
        const constraints = {};
        if (audio) constraints.audio = {
            echoCancellation: {
                exact: true,
            }
        };
        if(camera) constraints.video = {
                width: 1280, height: 780
            }

        if(screen){
            constraints.video = {
                mediaSource: "screen", width: 1280, height: 780
            }
        }

        this.init(constraints, videoElement);
    }
    
}