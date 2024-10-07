import { cn } from '@/lib/utils';
import { useForm } from '@inertiajs/react';
import { Form, FormField, FormSubmit } from '@radix-ui/react-form';
import { FormEventHandler, useRef } from 'react';
import ReCAPTCHA from 'react-google-recaptcha';
import Button from '../UI/Button';
import { Input, InputLabel, InputMessage } from '../UI/Input';
import { showToast } from '../UI/Toast';
import PasswordInput from './PasswordInput';

const RegisterForm = ({ className }: { className?: string }) => {
    const recaptchaRef = useRef<ReCAPTCHA | null>(null);

    const { data, setData, post, processing, errors, reset } = useForm({
        name_company: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();

        if (!recaptchaRef.current || !recaptchaRef.current.getValue()) {
            showToast('Captcha harus diisi!', 'destructive');
            return reset('password', 'password_confirmation');
        }

        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
            onSuccess: () =>
                showToast('Berhasil membuat akun mitra!', 'success'),
            onError: (error) => {
                showToast(
                    'Terjadi kesalahan, silakan coba lagi.',
                    'destructive',
                );
                console.error(error);
            },
        });
    };

    return (
        <Form onSubmit={handleSubmit} className={cn('grid gap-y-6', className)}>
            <FormField name="email" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Email</InputLabel>
                    <InputMessage match="typeMismatch">
                        Format email tidak valid.
                    </InputMessage>
                    <InputMessage match="valueMissing">
                        Email tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.email}</InputMessage>
                </div>
                <Input
                    type="email"
                    placeholder="Masukan email Anda"
                    autoComplete="email"
                    required
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                />
            </FormField>
            <FormField name="name_company" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Nama Perusahaan</InputLabel>
                    <InputMessage match="valueMissing">
                        Nama Perusahaan tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.name_company}</InputMessage>
                </div>
                <Input
                    type="text"
                    placeholder="Masukan nama perusahaan Anda"
                    autoComplete="name"
                    required
                    value={data.name_company}
                    onChange={(e) => setData('name_company', e.target.value)}
                />
            </FormField>
            <FormField name="password" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Kata Sandi</InputLabel>
                    <InputMessage match="valueMissing">
                        Kata Sandi tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.password}</InputMessage>
                </div>
                <PasswordInput
                    placeholder="Masukan kata sandi Anda"
                    autoComplete="new-password"
                    required
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
            </FormField>
            <FormField name="password_confirmation" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Konfirmasi Kata Sandi</InputLabel>
                    <InputMessage match="valueMissing">
                        Kata Sandi tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.password_confirmation}</InputMessage>
                </div>
                <PasswordInput
                    placeholder="Konfirmasi kata sandi Anda"
                    autoComplete="new-password"
                    required
                    value={data.password_confirmation}
                    onChange={(e) =>
                        setData('password_confirmation', e.target.value)
                    }
                />
            </FormField>
            <ReCAPTCHA
                sitekey={import.meta.env.VITE_RECAPTCHA_SITE_KEY}
                ref={recaptchaRef}
            />
            <FormSubmit asChild>
                <Button
                    variant="secondary"
                    disabled={processing}
                    className="mt-2.5 w-[300px]"
                >
                    Daftar
                </Button>
            </FormSubmit>
        </Form>
    );
};

export default RegisterForm;
