@extends('layouts.app')

@section('contents')
    <div class="flex flex-col gap-2 justify-center items-center h-screen">
        {{-- speack --}}
        <div class="font-bold text-2xl md:text-3xl text-[#d0fbd9] uppercase">
            <h1>Exousia Navi</h1>
        </div>
        <div class="relative flex justify-center items-center">
            <div
                class="loader flex items-center justify-center w-[100px] md:w-[200px] h-[100px] md:h-[200px] border rounded-full">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <div class="absolute">
                    <h1>Exousia Navi</h1>
                </div>
            </div>
            <div class="absolute">
                <div class="font-bold text-base md:text-2xl text-[#037937]">
                    <h1>EN</h1>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center gap-4 font-bold text-xl text-[#d0fbd9] uppercase">
            <h1 class="w-[80%] text-center">Eastwoods Professional College</h1>
            <div class="flex flex-wrap items-stretch justify-center gap-2">
                <a href="#" class="text-2xl border border-red-500 p-1 rounded-md text-red-500 hover:scale-110"><i
                        class="fa-solid fa-microphone-slash"></i></a>
                <a href="#" class="text-2xl border p-1 rounded-md hover:scale-110"><i
                        class="fa-sharp fa-solid fa-person-circle-question"></i></a>
                <a href="#" class="text-2xl border p-1 px-2 rounded-md hover:scale-110"><i class="fa-solid fa-chair-office"></i></a>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        let synth = window.speechSynthesis;
        let voices = [];
        let greetings = @json($greetings);
        // console.log(greetings)
        $(document).ready(function() {
            
            window.speechSynthesis.onvoiceschanged = () => {
                voices = window.speechSynthesis.getVoices();
            };
            stopSpeech()
            speakResponse(greetings)
                .then(() => {
                    stopSpeech();
                })
                .catch((error) => {
                    stopSpeech();
                });


        })

        const speakResponse = (text) => {
            return new Promise((resolve, reject) => {
                const utterance = new SpeechSynthesisUtterance(text);

                // Wait until voices are loaded
                if (voices.length === 0) {
                    voices = synth.getVoices();
                }

                let femaleVoice = voices.find(
                    (voice) =>
                    voice.name.includes("Google UK English Female") ||
                    voice.name.includes("Google US English Female")
                );

                if (!femaleVoice) {
                    // Fallback to first female voice if specific Google voice not found
                    femaleVoice = voices.find((voice) =>
                        voice.name.includes("Female")
                    );
                }

                if (femaleVoice) {
                    utterance.voice = femaleVoice;
                    utterance.pitch = 1;
                    utterance.rate = 1;

                    // Event listener for when speech synthesis has finished
                    utterance.onend = function() {
                        console.log("Speech synthesis finished.");
                        resolve();
                    };

                    // Event listener for error
                    utterance.onerror = function(error) {
                        console.error("Speech synthesis error:", error);
                        reject(error);
                    };

                    synth.speak(utterance);
                } else {
                    const error = new Error("No female voice available");
                    console.error(error.message);
                    reject(error);
                }
            });
        }

        const stopSpeech = () => {
            if (synth.speaking) {
                synth.cancel();
            }
        }
    </script>
@endsection
