export default class Recorder {

    static async init(constraints, screen) {
        let camStream, screenStream;
        try {
            camStream = await navigator.mediaDevices.getUserMedia(constraints);
            if(screen){
                screenStream = await navigator.mediaDevices.getDisplayMedia(screen);
            }
            if(camStream){
                const el = screen ? 'camera' : 'screen';
                this.handleStream(camStream, document.querySelector(`video#${el}`));
            }

            if(screenStream){
                this.handleStream(screenStream, document.querySelector(`video#screen`));
            }
        } catch (e) {
            console.error('error occurs', e);
        }
    }

    static handleStream(stream, videoElement) {
        videoElement.srcObject = stream;
    }

    static record(screen = false, camera = false, audio = false) {
        const constraints = {};
        if (audio) constraints.audio = {
            echoCancellation: {
                exact: true,
            }
        };
        if(camera) constraints.video = true;

        if(screen){
            screen = {video: true};
            if(audio) screen.audio = true;
        }


        this.init(constraints, screen);
    }
    
}