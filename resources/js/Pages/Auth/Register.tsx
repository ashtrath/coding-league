import RegisterForm from '@/Components/Form/RegisterForm';
import Button from '@/Components/UI/Button';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link } from '@inertiajs/react';
import { RiArrowLeftLine } from '@remixicon/react';

export default function Login() {
    return (
        <GuestLayout>
            <Head title="Register" />

            <div className="flex items-center divide-x divide-gray-300">
                <div className="flex max-w-[500px] flex-col gap-6 px-10 py-[60px]">
                    <Link
                        href="/"
                        className="inline-flex w-fit items-center gap-2 font-medium text-brand transition-colors hover:text-brand/80"
                    >
                        <RiArrowLeftLine size={24} />
                        Kembali ke halaman utama
                    </Link>
                    <div className="space-y-3">
                        <h2 className="text-4xl font-semibold text-gray-800">
                            Registrasi Mitra
                        </h2>
                        <p className="text-gray-600">
                            Silakan masukan email dan kata sandi untuk masuk ke
                            halaman dashboard Anda
                        </p>
                    </div>
                    <Button asChild variant="secondary" className="w-fit">
                        <Link href={route('login')}>
                            Sudah punya akun?&nbsp;
                            <span className="text-brand">Klik di sini</span>
                        </Link>
                    </Button>
                </div>

                <RegisterForm className="w-full px-10 py-[60px]" />
            </div>
        </GuestLayout>
    );
}
